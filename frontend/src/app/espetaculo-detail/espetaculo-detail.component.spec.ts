import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EspetaculoDetailComponent } from './espetaculo-detail.component';

describe('EspetaculoDetailComponent', () => {
  let component: EspetaculoDetailComponent;
  let fixture: ComponentFixture<EspetaculoDetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EspetaculoDetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EspetaculoDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
