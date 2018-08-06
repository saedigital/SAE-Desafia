import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class EspetaculosService {

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
      this.http.get(this.apiUrl + 'espetaculos/' + id + '/', this.httpOptions).subscribe(data => {
        resolve(data);
      }, err => {
        console.log(err);
      });
    });
  }

  getAll() {
    return new Promise(resolve => {
      this.http.get(this.apiUrl + 'espetaculos/', this.httpOptions).subscribe(data => {
        console.log(data)
        resolve(data);
      }, err => {
        console.log(err);
      });
    });
  }

  create(data) {
    return new Promise(resolve => {
      this.http.post(this.apiUrl + 'espetaculos/', data, this.httpOptions).subscribe(data => {
        console.log(data)
        resolve(data);
      }, err => {
        console.log(err);
      });
    });
  }

  update(id, obj) {
    console.log('>>>', obj)
    return new Promise(resolve => {
      this.http.put(this.apiUrl + 'espetaculos/' + id + '/', obj, this.httpOptions).subscribe(data => {
        resolve(data);
      }, err => {
        console.log(err);
      });
    });
  }

  delete(id) {    
    return new Promise(resolve => {
      this.http.delete(this.apiUrl + 'espetaculos/' + id + '/', this.httpOptions).subscribe(data => {
        resolve(data);
      }, err => {
        console.log(err);
      });
    });
  }

}