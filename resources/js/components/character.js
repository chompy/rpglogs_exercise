import React, { Component } from 'react'

export default class Character extends Component
{

    constructor(props)
    {
        super(props);
    }

    render()
    {
        return <div className="character row">
            <div className="character-portrait">
                <img src="https://img2.finalfantasyxiv.com/f/4f36905f9252dacc597fa93a0a65c55c_ba22853447012a24cee115315d6a5bebfc0_96x96.jpg?1631480144" alt="c" />
            </div>
            <div className="character-details">
                <div className="character-name">Minda Silva</div>
                <div className="character-server">Sargatanas (NA)</div>
                <div className="character-class">
                    <img className="class-icon" src="https://assets.rpglogs.com/img/ff/icons/Scholar.png" />
                    Scholar
                </div>
            </div>
        </div>;
    }

}
