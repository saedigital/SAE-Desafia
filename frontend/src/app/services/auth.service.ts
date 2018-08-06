import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { HttpHeaders } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  public apiUrl = 'http://localhost:8000/';
  public httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json',
    })
  };

  constructor(
    public http: HttpClient
  ) { }

  login(data){
    return new Promise(resolve => {
      this.http.post(this.apiUrl + 'api-token-auth/', data, this.httpOptions)
        .subscribe(data => {
          resolve(data);
        }, err => {
          console.log(err);
        });
    });

  }

  signup(data){
    return new Promise(resolve => {
      this.http.post(this.apiUrl + 'api-token-auth/signup/', data, this.httpOptions)
        .subscribe(data => {
          resolve(data);
        }, err => {
          console.log(err);
        });
    });

  }
}
