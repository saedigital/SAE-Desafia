import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EspetaculosListComponent } from './espetaculos-list.component';

describe('EspetaculosListComponent', () => {
  let component: EspetaculosListComponent;
  let fixture: ComponentFixture<EspetaculosListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EspetaculosListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EspetaculosListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
