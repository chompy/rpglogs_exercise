import React, { Component } from 'react'
import CharacterParse from './character_parse'
import CharacterInfo from './character_info';
import { parseEncounterName, parseClass, parseRank, parseDamage, parseDuration, parseDate } from '../terms';

/** List all available parsed encountered. */
export default class ResultsCharacterParses extends Component
{
    renderResults()
    {
        let out = [];
        for (let i in this.props.data.parses) {
            let data = this.props.data.parses[i];
            let key = 'results_' + i;
            out.push(<CharacterParse key={key} data={data}></CharacterParse>);
        }
        return out;
    }

    render()
    {
        return <div className="parses row">
            <CharacterInfo data={this.props.data}></CharacterInfo>
            <div className="parse head row">
                <div className="parse-encounter-name" title={parseEncounterName}>{parseEncounterName}</div>
                <div className="parse-class" title={parseClass}>{parseClass}</div>
                <div className="parse-rank" title={parseRank}>{parseRank}</div>
                <div className="parse-damage" title={parseDamage}>{parseDamage}</div>
                <div className="parse-duration" title={parseDuration}>{parseDuration}</div>
                <div className="parse-date" title={parseDate}>{parseDate}</div>
            </div>
            {this.renderResults()}
        </div>;
    }

}