import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ReservasService {

  public apiUrl = 'http://localhost:8000/api/';
  public httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
      // 'Authorization': 'Token ' + localStorage.getItem('token')
    })
  };

  constructor(
    public http: HttpClient
  ) { }

  create(data) {
    return new Promise(resolve => {
      this.http.post(this.apiUrl + 'reservas/', data, this.httpOptions).subscribe(data => {
        console.log(data)
        resolve(data);
      }, err => {
        console.log(err);
      });
    });
  }

  delete(id) {
    return new Promise(resolve => {
      this.http.delete(this.apiUrl + 'reservas/' + id +'/', this.httpOptions).subscribe(data => {
        console.log(data)
        resolve(data);
      }, err => {
        console.log(err);
      });
    });
  }

}
