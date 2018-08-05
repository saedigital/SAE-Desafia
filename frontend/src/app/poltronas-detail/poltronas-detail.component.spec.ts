import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PoltronasDetailComponent } from './poltronas-detail.component';

describe('PoltronasDetailComponent', () => {
  let component: PoltronasDetailComponent;
  let fixture: ComponentFixture<PoltronasDetailComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PoltronasDetailComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PoltronasDetailComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
