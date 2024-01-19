const notificationController = require('./controllers/notificationController')

const controllers = (repositories, io) => {
    return {
        notificationController: notificationController.bind(null, repositories, io)
    }
}

module.exports = controllers