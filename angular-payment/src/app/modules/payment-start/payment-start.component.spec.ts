import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PaymentStartComponent } from './payment-start.component';

describe('PaymentStartComponent', () => {
  let component: PaymentStartComponent;
  let fixture: ComponentFixture<PaymentStartComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PaymentStartComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PaymentStartComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
