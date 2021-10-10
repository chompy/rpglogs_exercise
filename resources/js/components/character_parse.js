import React, { Component } from 'react'

/** Display parse results of an encounter. */
export default class CharacterParse extends Component
{

    getBossIcon()
    {
        return 'https://assets.rpglogs.com/img/ff/bosses/' + this.props.data.encounterID + '-icon.jpg';
    }

    getClassIcon()
    {
        return 'https://assets.rpglogs.com/img/ff/icons/' + this.props.data.spec + '.png';
    }

    getPercentile()
    {
        return parseInt(Math.floor(this.props.data.percentile));
    }

    getRank()
    {
        return this.props.data.rank + '/' + this.props.data.outOf;
    }

    parsePercentClassName()
    {
        let percent = this.getPercentile();
        if (percent == 100) {
            return 'parse-rank-percent artifact';
        } else if (percent == 99) {
            return 'parse-rank-percent astounding';
        } else if (percent >= 90) {
            return 'parse-rank-percent legendary';
        } else if (percent >= 75) {
            return 'parse-rank-percent epic';
        } else if (percent >= 40) {
            return 'parse-rank-percent rare';
        } else if (percent >= 20) {
            return 'parse-rank-percent uncommon';
        }
        return 'parse-rank-percent common';
    }

    render()
    {
        return <div className="parse row">
            <div className="parse-encounter-name" title={this.props.data.encounterName}>
                <img
                    className="encounter-icon"
                    src={this.getBossIcon()} 
                    alt={this.props.data.encounterName}
                    title={this.props.data.encounterName}
                />
                {this.props.data.encounterName}
            </div>
            <div className="parse-class">
                <img className="class-icon" src={this.getClassIcon()} alt={this.props.data.spec} title={this.props.data.spec} />
            </div>
            <div className="parse-rank">
                <span className={this.parsePercentClassName()} title={this.getPercentile() + '%'}>{this.getPercentile()}</span>
                <span className="parse-rank-value" title={this.getRank()}>({this.getRank()})</span>
            </div>
            <div className="parse-damage" title={this.props.data.total}>
                {this.props.data.total}
            </div>
            <div className="parse-duration">
                9:15
            </div>
            <div className="parse-date">
                Jan 1, 2021
            </div>
        </div>;
    }

}