import PlatformClientService from './Client/PlatformClientService'
import qs from 'qs'

export default class ReservaService extends PlatformClientService {
  constructor(config) {
    super(config)
    this.params = null
  }

  listBookings(params) {
    return Promise.resolve(this.client.get(`/reservas/espetaculo/${params.id}`))
  }

  remove(params) {
    return Promise.resolve(this.client.get(`/reservas/${params.id}/excluir`))
  }

  create(params) {
    return Promise.resolve(this.client.post('/reservas/reservar', qs.stringify(params), {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }))
  }
}
