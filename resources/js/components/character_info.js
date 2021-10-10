import React, { Component } from 'react'

/** Display information about a character. */
export default class CharacterInfo extends Component
{
    
    getClasses()
    {
        let out = [];
        for (let i in this.props.data.parses) {
            let parse = this.props.data.parses[i];
            if (out.indexOf(parse.spec) == -1) {
                out.push(parse.spec);
            }
        }
        return out;
    }

    getClassIcon(name)
    {
        return 'https://assets.rpglogs.com/img/ff/icons/' + name + '.png';
    }

    renderClasses()
    {
        let out = [];
        let classes = this.getClasses();
        for (let i in classes) {
            let className = classes[i];
            let key = "class_" + i;
            out.push(
                <img key={key} className="class-icon" src={this.getClassIcon(className)} alt={className} title={className} />
            );
        }
        return out;
    }

    getServer()
    {
        return this.props.data.parses[0].server + ' (' + this.props.data.serverRegion + ')';
    }

    render()
    {
        return <div className="character row">
            <div className="character-portrait">
                <img
                    src={this.props.data.characterAvatarURL}
                    alt={this.props.data.parses[0].characterName}
                    title={this.props.data.parses[0].characterName}
                />
            </div>
            <div className="character-details">
                <div className="character-name" title={this.props.data.parses[0].characterName}>{this.props.data.parses[0].characterName}</div>
                <div className="character-server" title={this.getServer()}>{this.getServer()}</div>
                <div className="character-class">
                    {this.renderClasses()}
                </div>
            </div>
        </div>;
    }

}
