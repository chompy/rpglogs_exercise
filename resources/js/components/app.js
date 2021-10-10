import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import CharacterParseForm from './character_parse_form';
import Results from './results';
import { fetchCharacterParsesHistory } from '../api';

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

ReactDOM.render(
    <App />, 
    document.getElementById('app'),
    function() {
        fetchCharacterParsesHistory();
    }
);