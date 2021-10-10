import React, { Component } from 'react'
import { formCharacterName, formRegionName, formServerName, randomCharacterName, randomServerName } from '../terms';
import { fetchCharacterParses } from '../api';

/** Form for character parses fetch. */
export default class CharacterParseForm extends Component
{

    constructor(props)
    {
        super(props);
        this.state = {
            character: '',
            server: '',
            region: '',
            error: '',
            characterPlaceholder: this.randomCharacterNames().join(', ') + '...',
            serverPlaceholder: this.randomServerNames().join(', ') + '...',
        };
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }

    randomCharacterNames()
    {
        let out = [];
        while (out.length < 3) {
            let name = randomCharacterName();
            if (out.indexOf(name) == -1) {
                out.push(name);
            }
        }
        return out;        
    }

    randomServerNames()
    {
        let out = [];
        while (out.length < 3) {
            let name = randomServerName();
            if (out.indexOf(name) == -1) {
                out.push(name);
            }
        }
        return out;   
    }

    errorMessageClass()
    {
        if (this.state.error) {
            return 'error-message has-error';
        }
        return 'error-message';
    }

    handleChange(event)
    {
        event.preventDefault();
        this.setState({
            error: '',
            [event.target.getAttribute('id')]: event.target.value
        });
    }

    handleSubmit(event)
    {
        event.preventDefault();
        // validate
        if (
            !this.state.character ||
            !this.state.server ||
            !this.state.region            
        ) {
            this.setState({
                error: 'All fields are required.'
            });
            return;
        }
        // perform fetch
        fetchCharacterParses(
            this.state.character,
            this.state.server,
            this.state.region
        );
    }

    render()
    {
        return <div className="panel search-form col-2">
            <form className="panel-body" onSubmit={this.handleSubmit}>
                <div className="row">
                    <label htmlFor="character">{formCharacterName}</label>
                    <input 
                        type="text" 
                        id="character" 
                        name="character" 
                        onChange={this.handleChange}
                        placeholder={this.state.characterPlaceholder}
                    />
                </div>
                <div className="row">
                    <label htmlFor="server">{formServerName}</label>
                    <input
                        type="text"
                        id="server"
                        name="server"
                        onChange={this.handleChange}
                        placeholder={this.state.serverPlaceholder}
                    />
                </div>
                <div className="row">
                    <label htmlFor="region">{formRegionName}</label>
                    <input
                        type="text"
                        id="region"
                        name="region"
                        onChange={this.handleChange}
                        placeholder="NA, EU, JP..."
                    />
                </div>
                <div className="row">
                    <input type="submit" value="Fetch" />
                    <div className={this.errorMessageClass()}>{this.state.error}</div>
                </div>
            </form>
        </div>;
    }

}
