const itemRepositories = require('./repositories/itemRepositories')

const repositories = (database) => {

    const table = {
        Item: database('items'),
        User: database('users')
    }

    return {
        itemRepositories: itemRepositories(table)
    }
    
}

module.exports = repositories