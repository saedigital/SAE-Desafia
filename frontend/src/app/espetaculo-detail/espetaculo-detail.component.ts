import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { EspetaculosService } from '../services/espetaculos.service';

@Component({
  selector: 'app-espetaculo-detail',
  templateUrl: './espetaculo-detail.component.html',
  styleUrls: ['./espetaculo-detail.component.css']
})
export class EspetaculoDetailComponent implements OnInit {

  public espetaculo : any

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private espetaculoService: EspetaculosService,
  ) { }

  ngOnInit() {
    this.route.params.subscribe(params => {
      this.espetaculoService.get(params.id).then((data)=>{
        this.espetaculo = data;
      })
      
    })
  }

  cancelar(){
    console.log(this.espetaculo)
    this.espetaculoService.delete(this.espetaculo.id).then((data)=>{
      this.espetaculo = data;
    })
  }

  editar(){
    this.espetaculoService.update(this.espetaculo).then((data)=>{
      this.router.navigateByUrl('');
      // this.espetaculo = data;
    })
  }

}
