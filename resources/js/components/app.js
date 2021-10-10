import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import CharacterParseForm from './character_parse_form';
import Results from './results';
//import { BrowserRouter, Route, Switch } from 'react-router-dom'
//import Header from './Header'

class App extends Component
{

    render()
    {
        return <div className="row">
            <CharacterParseForm></CharacterParseForm>
            <Results></Results>
        </div>;
    }

}

ReactDOM.render(<App />, document.getElementById('app'))