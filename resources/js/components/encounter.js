import React, { Component } from 'react'

export default class Encounter extends Component
{

    parsePercentClassName()
    {
        return 'encounter-rank-percent epic';
    }

    render()
    {
        return <div className="encounter row">
            <div className="encounter-name">
                <img className="encounter-icon" src="https://assets.rpglogs.com/img/ff/bosses/73-icon.jpg" />
                Cloud of Darkness
            </div>
            <div className="encounter-class">
                <img className="class-icon" src="https://assets.rpglogs.com/img/ff/icons/Scholar.png" alt="Scholar" title="Scholar" />
            </div>
            <div className="encounter-rank">
                <span className={this.parsePercentClassName()}>76</span>
                <span className="encounter-rank-value">(907/9497)</span>
            </div>
            <div className="encounter-damage" title="11849.6">
                11849.6
            </div>
            <div className="encounter-duration">
                9:15
            </div>
            <div className="encounter-date">
                Jan 1, 2021
            </div>
        </div>;
    }

}