import React, { Component } from 'react'

/** Display information about a character. */
export default class CharacterInfo extends Component
{

    getClassIcon()
    {
        return 'https://assets.rpglogs.com/img/ff/icons/' + this.props.data.spec + '.png';
    }

    getServerRegion()
    {
        return this.props.data.server + ' (NA)';
    }

    render()
    {
        return <div className="character row">
            <div className="character-portrait">
                <img src="https://img2.finalfantasyxiv.com/f/4f36905f9252dacc597fa93a0a65c55c_ba22853447012a24cee115315d6a5bebfc0_96x96.jpg?1631480144" alt="c" />
            </div>
            <div className="character-details">
                <div className="character-name" title={this.props.data.characterName}>{this.props.data.characterName}</div>
                <div className="character-server" title={this.getServerRegion()}>{this.getServerRegion()}</div>
                <div className="character-class" title={this.props.data.spec}>
                    <img className="class-icon" src={this.getClassIcon()} alt={this.props.data.spec} title={this.props.data.spec} />
                    {this.props.data.spec}
                </div>
            </div>
        </div>;
    }

}
