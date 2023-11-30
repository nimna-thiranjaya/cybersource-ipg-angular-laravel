import { RouterModule, Routes } from '@angular/router';
import { NgModule } from '@angular/core';
import { PaymentStartComponent } from './modules/payment-start/payment-start.component';

const routes: Routes = [
  {
    path: '',
    component: PaymentStartComponent,
  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
  // imports: [
  //     RouterModule.forRoot([
  //         {
  //             path: '', component: AppMainComponent,
  //             // children: [
  //             //     {path: 'blocks', component: BlocksComponent},
  //             // ]
  //         },
  //         {path: '**', redirectTo: '/notfound'},
  //     ], {scrollPositionRestoration: 'enabled'})
  // ],
  // exports: [RouterModule]
})
export class AppRoutingModule {}
