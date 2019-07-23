import PlatformClientService from './Client/PlatformClientService'
import qs from 'qs'

export default class EspetaculoService extends PlatformClientService {
  constructor(config) {
    super(config)
    this.params = null
  }

  getAll() {
    return Promise.resolve(this.client.get('/espetaculos'))
  }

  getEspetaculo(params) {
    return Promise.resolve(this.client.get(`/espetaculos/${params.id}`))
  }

  update(params) {
    let bodyParams = Object.assign({}, params)
    delete bodyParams.id
    return Promise.resolve(this.client.put(`/espetaculos/${params.id}/atualiza`, qs.stringify(bodyParams), {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }))
  }

  remove(params) {
    return Promise.resolve(this.client.get(`/espetaculos/${params.id}/excluir`))
  }

  create(params) {
    return Promise.resolve(this.client.post('/espetaculos/cadastro', qs.stringify(params), {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }))
  }
}
