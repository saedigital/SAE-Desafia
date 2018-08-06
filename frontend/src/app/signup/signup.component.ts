
import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { AuthService } from '../services/auth.service';
import {Location} from '@angular/common';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.css']
})
export class SignupComponent implements OnInit {

  public username: string;
  public password: string;
  public data: any;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private loginService: AuthService,
    private _location: Location,
  ) { }

  ngOnInit() {
  }


  signup() {

    this.data = {
      'email': this.username,
      'password': this.password,
    }
    
    console.log(this.data)
    
    this.loginService.signup(this.data)
    .then((response) => {
        window.localStorage.setItem('token', response['token'])
        this.router.navigate(['']); 
        // this._location.back();
        console.log(response)
      }, (err)=>{
        console.log(err)
      })
  
  }


}