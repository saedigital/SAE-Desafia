import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PoltronasListComponent } from './poltronas-list.component';

describe('PoltronasListComponent', () => {
  let component: PoltronasListComponent;
  let fixture: ComponentFixture<PoltronasListComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PoltronasListComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PoltronasListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
