import React, { Component } from 'react'


/** Display api results to user. */
export default class ResultsError extends Component
{

    constructor(props)
    {
        super(props)
    }

    render()
    {
        return <div className="error">
            <em>{this.props.message}</em>
        </div>;
    }

}