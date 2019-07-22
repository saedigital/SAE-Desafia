import PlatformClientService from './Client/PlatformClientService'

export default class EspetaculoService extends PlatformClientService {
  constructor(config) {
    super(config)
    this.params = null
  }

  getAll() {
    return Promise.resolve(this.client.get('/espetaculos'))
  }
}
