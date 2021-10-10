import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import SearchForm from './search_form';
import SearchResults from './search_results';
//import { BrowserRouter, Route, Switch } from 'react-router-dom'
//import Header from './Header'

class App extends Component
{

    render()
    {
        return <div className="row">
            <SearchForm></SearchForm>
            <SearchResults></SearchResults>
        </div>;
    }

}

ReactDOM.render(<App />, document.getElementById('app'))