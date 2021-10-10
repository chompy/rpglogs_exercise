import React, { Component } from 'react'
import ResultsCharacterParses from './results_character_parses';
import ResultsError from './results_error';
import ResultsPreviousQueries from './results_previous_queries';

/** Display api results to user. */
export default class Results extends Component
{

    constructor(props)
    {
        super(props);
        this.state = {
            results: null
        };
        this.handleApiLoad = this.handleApiLoad.bind(this);
        this.handleApiResults = this.handleApiResults.bind(this);
    }

    componentDidMount()
    {
        window.addEventListener('api:load', this.handleApiLoad)
        window.addEventListener('api:error', this.handleApiResults);
        window.addEventListener('api:success', this.handleApiResults)
    }

    componentWillUnmount()
    {
        super.componentWillUnmount();
        window.removeEventListener('api:load', this.handleApiLoad);
        window.removeEventListener('api:error', this.handleApiResults);
        window.removeEventListener('api:success', this.handleApiResults);
    }

    handleApiLoad()
    {
        this.setState({
            results: null
        });
    }

    handleApiResults(event)
    {
        this.setState({
            results: event.detail
        });
    }

    renderResults()
    {
        if (!this.state.results) {
            return;
        }
        if (!this.state.results.success) {
            return <ResultsError message={this.state.results.message}></ResultsError>;
        }
        switch (this.state.results.type) {
            case 'character_parses':
            {
                return <ResultsCharacterParses data={this.state.results.data}></ResultsCharacterParses>;
            }
        }
    }

    render()
    {
        if (!this.state.results) {
            return <div className="panel results col-6 loading"></div>;
        }
        return <div className="panel results col-6">
            <div className="panel-body">
                {this.renderResults()}
            </div>
        </div>;
    }

}
