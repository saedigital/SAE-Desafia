import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { PoltronasService } from '../services/poltronas.service';
import { ReservasService } from '../services/reservas.service';
import {Location} from '@angular/common';


@Component({
  selector: 'app-poltronas-list',
  templateUrl: './poltronas-list.component.html',
  styleUrls: ['./poltronas-list.component.css']
})
export class PoltronasListComponent implements OnInit {

  public poltronas: any;
  public espetaculo_id: number;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private poltronasService: PoltronasService,
    private reservasService: ReservasService,
    private _location: Location,
  ) { }

  ngOnInit() {
    
    this.route
      .queryParams
      .subscribe(params => {
        this.espetaculo_id = params['espetaculo']
        console.log(this.espetaculo_id);
        this.poltronasService.getAll(this.espetaculo_id).then((response)=>{
          this.poltronas = response['results'];
          console.log(response)
        })
      });


  }

  reservar(id){
    let data = {
      poltrona:id
    }
    this.reservasService.create(data).then((response)=>{
      this._location.back();
      // alert('Reservado com sucesso.')
    })

  }

  cancelar(id){
    console.log(id)
    if (id)
      this.reservasService.delete(id).then((response)=>{
        this._location.back();
        // alert('Cancelado com sucesso.')
      })

  }

}
