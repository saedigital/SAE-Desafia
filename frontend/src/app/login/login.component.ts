import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { AuthService } from '../services/auth.service';
import {Location} from '@angular/common';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  public username: string;
  public password: string;
  public data: any;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private loginService: AuthService,
    private _location: Location,
  ) { 
  }

  ngOnInit() {
  }

  login() {

    this.data = {
      'username': this.username,
      'password': this.password,
    }
    
    console.log(this.data)
    
    this.loginService.login(this.data)
    .then((response) => {
        window.localStorage.setItem('token', response['token'])
        this._location.back();
        console.log(response)
      }, (err)=>{
        console.log(err)
      })
  
  }

}
