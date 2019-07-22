import axios from 'axios'

export default class PlatformClientService {
  constructor(config) {
    if (this.constructor === PlatformClientService) {
      throw new Error('You can\'t instantiate an abstract class.')
    }
    this.client = null
    this.createClient(config)
  }

  createClient() {
    this.client = axios.create({
      baseURL: `http://localhost:${process.env.PORT || 4000}`,
      responseType: 'json',
      headers: {
        Accept: 'application/json',
      },
    })
  }
}
