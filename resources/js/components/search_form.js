import React, { Component } from 'react'
import { formCharacterName, formRegionName, formServerName, randomCharacterName, randomServerName } from '../terms';

export default class SearchForm extends Component
{

    render()
    {
        return <div className="panel search-form col-2">
            <form className="panel-body">
                <div className="row">
                    <label htmlFor="character">{formCharacterName}</label>
                    <input type="text" id="character" name="character" placeholder={randomCharacterName() + '...'} />
                </div>
                <div className="row">
                    <label htmlFor="server">{formServerName}</label>
                    <input type="text" id="server" name="server" placeholder={randomServerName() + '...'} />
                </div>
                <div className="row">
                    <label htmlFor="region">{formRegionName}</label>
                    <input type="text" name="region" placeholder="NA, EU, JP" />
                </div>
                <div className="row">
                    <input type="submit" value="Fetch" />
                </div>
            </form>
        </div>;
    }

}
