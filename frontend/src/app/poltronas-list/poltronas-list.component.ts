import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute } from '@angular/router';
import { PoltronasService } from '../services/poltronas.service';


@Component({
  selector: 'app-poltronas-list',
  templateUrl: './poltronas-list.component.html',
  styleUrls: ['./poltronas-list.component.css']
})
export class PoltronasListComponent implements OnInit {

  public poltronas: any;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private poltronasService: PoltronasService
  ) { }

  ngOnInit() {
    
    // this.sub = this.route
    //   .queryParams
    //   .subscribe(params => {
    //     // Defaults to 0 if no query param provided.
    //     this.page = +params['page'] || 0;
    //   });

    this.poltronasService.getAll(1).then((response)=>{
      this.poltronas = response['results'];
    })

  }

}
