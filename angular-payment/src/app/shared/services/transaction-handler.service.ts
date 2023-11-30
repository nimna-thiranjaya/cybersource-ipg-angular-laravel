import { Injectable } from '@angular/core';
import { Observable, Observer } from 'rxjs';
import { DataAccessService } from './data-access.service';
import { MasterDataService } from './master-data.service';
import { AppMessageService } from './app-message.service';
import { ResourceService } from './resource.service';
import { HelperService } from './helper.service';

@Injectable()
export class TransactionHandlerService {
  ///Login service count
  TOTAL_SERVICERS_COUNT = 1;
  locations: any[] = [];
  loggedResID: any

  constructor(
    private dataAccess: DataAccessService,
    private masterData: MasterDataService,
    private msgService: AppMessageService, 
    private helper: HelperService,
    private resource: ResourceService
  ) {  } 
  
  SignIn(body: any) { 
    return this.dataAccess._POST(this.resource.auth.signIn, body)
      .pipe((result) => {  
    return result
      })
  }

  ResetPassword(body: any) {
    return this.dataAccess.POST(this.resource.auth.resetPassword, body)
      .pipe((result) => { 
        return result
      })
  }

}
