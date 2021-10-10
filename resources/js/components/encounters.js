import React, { Component } from 'react'
import Encounter from './encounter';
import { encounterName, encounterClass, encounterRank, encounterDamage, encounterDuration, encounterDate } from '../terms';

export default class Encounters extends Component
{


    render()
    {
        return <div className="encounters row">
            <div className="encounter head row">
                <div className="encounter-name" title={encounterName}>{encounterName}</div>
                <div className="encounter-class" title={encounterClass}>{encounterClass}</div>
                <div className="encounter-rank" title={encounterRank}>{encounterRank}</div>
                <div className="encounter-damage" title={encounterDamage}>{encounterDamage}</div>
                <div className="encounter-duration" title={encounterDuration}>{encounterDuration}</div>
                <div className="encounter-date" title={encounterDate}>{encounterDate}</div>
            </div>
            <Encounter></Encounter>
            <Encounter></Encounter>
            <Encounter></Encounter>
        </div>;
    }

}