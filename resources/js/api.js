

export function fetchCharacterParses(character, server, region)
{
    apiLoad();
    fetch(
        '/api/character-parses?character=' + character + '&server=' + server + '&region=' + region
    )
        .then(res => res.json())
        .then(
            (result) => { apiSuccess(result); },
            (error) => { apiError(error); }
        )
    ;
}

export function fetchCharacterParsesHistory()
{
    apiLoad();
    fetch(
        '/api/character-parses-history'
    )
        .then(res => res.json())
        .then(
            (result) => { apiSuccess(result); },
            (error) => { apiError(error); }
        )
    ;
}

function apiLoad()
{
    window.dispatchEvent(new CustomEvent('api:load'));
}

function apiSuccess(res)
{
    window.dispatchEvent(new CustomEvent('api:success', {
        detail: res
    }));
}

function apiError(res)
{
    window.dispatchEvent(new CustomEvent('api:error', {
        detail: res
    }));
}