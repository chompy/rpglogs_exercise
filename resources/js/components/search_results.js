import React, { Component } from 'react'
import Character from './character';
import Encounters from './encounters';

export default class SearchResults extends Component
{

    constructor(props)
    {
        super(props);
        this.state = {
            loading: false
        };
    }

    render()
    {
        if (this.state.loading) {
            return <div className="panel search-results col-6 loading"></div>;
        }
        return <div className="panel search-results col-6">
            <div className="panel-body">
                <Character></Character>
                <Encounters></Encounters>
            </div>
        </div>;
    }

}
