import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { EspetaculosService } from '../services/espetaculos.service';

@Component({
  selector: 'app-espetaculos-list',
  templateUrl: './espetaculos-list.component.html',
  styleUrls: ['./espetaculos-list.component.css']
})
export class EspetaculosListComponent implements OnInit {

  public espetaculos: any;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private espetaculosService: EspetaculosService
  ) { }

  ngOnInit() {
    
    this.espetaculosService.getAll().then((response)=>{
      this.espetaculos = response['results'];
    })

  }

}
