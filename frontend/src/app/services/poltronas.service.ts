import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { HttpHeaders } from '@angular/common/http';


@Injectable({
  providedIn: 'root'
})
export class PoltronasService {

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


  get(id) {
    console.log('>>>', id)
    return new Promise(resolve => {
      this.http.get(this.apiUrl + 'poltronas/' + id + '/', this.httpOptions).subscribe(data => {
        resolve(data);
      }, err => {
        console.log(err);
      });
    });
  }

  getAll(espetaculo) {
    return new Promise(resolve => {
      this.http.get(this.apiUrl + 'poltronas/?espetaculo='+ espetaculo, this.httpOptions).subscribe(data => {
        console.log(data)
        resolve(data);
      }, err => {
        console.log(err);
      });
    });
  }

  create(data) {
    return new Promise(resolve => {
      this.http.post(this.apiUrl + 'poltronas/', data, this.httpOptions).subscribe(data => {
        console.log(data)
        resolve(data);
      }, err => {
        console.log(err);
      });
    });
  }

}