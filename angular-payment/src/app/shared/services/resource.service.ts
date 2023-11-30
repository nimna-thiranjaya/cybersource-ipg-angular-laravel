import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class ResourceService { 
  constructor() { }

  private Auth = '/auth/';
  private InventoryService = '/inventory/';
  private AdminService = '/admin/';

  auth = {
    signIn: this.Auth + 'signIn',
    resetPassword: this.Auth + 'reset-password',
  };
}
