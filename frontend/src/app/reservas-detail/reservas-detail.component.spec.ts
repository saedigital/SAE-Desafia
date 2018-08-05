import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ReservasDetailComponent } from './reservas-detail.component';

describe('ReservasDetailComponent', () => {
  let component: ReservasDetailComponent;
  let fixture: ComponentFixture<ReservasDetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ReservasDetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ReservasDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
