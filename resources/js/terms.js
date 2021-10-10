
// form labels
export const formCharacterName = 'Character Name';
export const formServerName = 'Server Name';
export const formRegionName = 'Region';

// encounter table head
export const encounterName = 'Raid';
export const encounterClass = 'Job';
export const encounterRank = 'Rank'
export const encounterDamage = 'DPS';
export const encounterDuration = 'Duration';
export const encounterDate = 'Date';

/**
 * Sample character names.
 * @var {array}
 * @see https://genr8rs.com/Generator/Rpg/NameGenerator
 */
export var sampleCharacterNames = [
    'Hawk Storm', 'Rocket Baltar', 'Romero Dotsk', 'Jhessail Mostana',
    'Tylos Starwalker', 'Scorpius Solace', 'Rolen Nailo', 'Shamil Beren',
    'Xavier Organa', 'Faila Basha', 'Lola Goodfellow', 'Xena Surtas'
];

/**
 * Pick name at random from sample character names.
 * @returns {string}
 */
export var randomCharacterName = function() {
    return sampleCharacterNames[Math.floor(Math.random() * sampleCharacterNames.length)];
}

/**
 * Sample server names.
 * @var {array}
 * @see https://na.finalfantasyxiv.com/lodestone/worldstatus/
 */
export var sampleServerNames = [
    'Adamantoise', 'Cactuar', 'Faerie', 'Gilgamesh', 'Jenova', 'Midgardsormr',
    'Sargatanas', 'Siren', 'Behemoth', 'Excalibur', 'Exodus', 'Famfrit', 'Hyperion', 
    'Lamia', 'Leviathan', 'Ultros', 'Balmung', 'Brynhildr', 'Coeurl', 'Diabolos',
    'Goblin', 'Malboro', 'Mateus', 'Zalera'
];

/**
 * Pick name at random from sample server names.
 * @returns {string}
 */
 export var randomServerName = function() {
    return sampleServerNames[Math.floor(Math.random() * sampleServerNames.length)];
}
