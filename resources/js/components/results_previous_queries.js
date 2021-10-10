import React, { Component } from 'react'
import { fetchCharacterParses } from '../api'
import { previousQueryNoResults } from '../terms'

/** Display previous queries. */
export default class ResultsPreviousQueries extends Component
{

    constructor(props)
    {
        super(props)
        this.handleClick = this.handleClick.bind(this);
    }

    handleClick(event)
    {
        event.preventDefault();
        fetchCharacterParses(
            event.target.getAttribute('data-character'),
            event.target.getAttribute('data-server'),
            event.target.getAttribute('data-region'),
        );
    }

    renderPreviousQueries()
    {
        let out = [];
        for (let i in this.props.data) {
            let item = this.props.data[i];
            let key = 'history_' + i;
            out.push(
                <a
                    key={key}
                    href="#"
                    className="previous-query"
                    data-character={item.character_name}
                    data-server={item.server_name}
                    data-region={item.server_region}
                    onClick={this.handleClick}
                >
                    <img src={item.avatar_url} alt={item.character_name} />
                    {item.character_name} / {item.server_name} / {item.server_region}
                </a>
            );
        }
        return out;
    }

    render()
    {
        if (this.props.data.length == 0) {
            return <div className="results previous-queries">
                <h3><em>{previousQueryNoResults}</em></h3>
            </div>;
        }
        return <div className="results previous-queries">
            <h3>Previous Queries</h3>
            {this.renderPreviousQueries()}
        </div>;
    }

}