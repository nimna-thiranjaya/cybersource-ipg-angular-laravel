import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { BehaviorSubject, Observable, of } from 'rxjs';
import { catchError, map } from 'rxjs/operators';
import { MasterDataService } from './master-data.service';  
import { ApiConfigService } from './api-config.service';

@Injectable({
  providedIn: 'root'
})
export class DataAccessService {
  public Request: BehaviorSubject<number> = new BehaviorSubject(0);
  private RequestCount = 0;
  AppData: any;
  constructor(
    private http: HttpClient,
    private apiConfigService: ApiConfigService,
    private masterData: MasterDataService
  ) {
    this.loadBaseUrl();
  }

  loadBaseUrl() {
    this.apiConfigService.getConfigJSON().subscribe((result) => {
      let store: any = result;
      this.AppData = store;
    })
  }



  GET(url: string, spinner = true): Observable<AppResponse> {
    let responseModel = new AppResponse();
    let serviceURL = this.AppData.baseURL;
    if (serviceURL == null) {
      responseModel.ErrorMessage = "Please Configure Application Settings!!";
      responseModel.isSuccessfull = false;
      return of(responseModel);
    } else {
      url = serviceURL + url;
    }
    if (spinner) {
      this.Request.next(++this.RequestCount);
    }

    let headers = new HttpHeaders().set("Authorization", this.masterData.SessionKey);
    return this.http.get<AppResponse>(url, { headers }).pipe(
      map((response) => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        return response;
      }),
      catchError(error => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        responseModel.ErrorMessage = error.message;
        responseModel.isSuccessfull = false;
        return of(responseModel);
      })
    );
  }

  POST(url: string, body: any, spinner = true): Observable<AppResponse> {
    let responseModel = new AppResponse();
    let serviceURL = this.AppData.baseURL;
    if (serviceURL == null) {
      responseModel.ErrorMessage = "Please Configure Application Settings!!";
      responseModel.isSuccessfull = false;
      return of(responseModel);
    } else {
      url = serviceURL + url;
    }
    if (spinner) {
      this.Request.next(++this.RequestCount);
    }

    let headers = new HttpHeaders().set("Authorization", this.masterData.SessionKey);
    return this.http.post<AppResponse>(url, body, { headers }).pipe(
      map((response) => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        return response;
      }),
      catchError(error => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        responseModel.ErrorMessage = error.message;
        responseModel.isSuccessfull = false;
        return of(responseModel);
      })
    );
  }

  _POST(url: string, body: any, spinner = true): Observable<AppResponse> {
    let responseModel = new AppResponse();
    let serviceURL = this.AppData.baseURL;
    if (serviceURL == null) {
      responseModel.ErrorMessage = "Please Configure Application Settings!!";
      responseModel.isSuccessfull = false;
      return of(responseModel);
    } else {
      url = serviceURL + url;
    }
    if (spinner) {
      this.Request.next(++this.RequestCount);
    }

    let headers = new HttpHeaders().set('Content-Type', 'application/json');
    return this.http.post<AppResponse>(url, body, { headers }).pipe(
      map((response) => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        return response;
      }),
      catchError(error => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        responseModel.ErrorMessage = error.message;
        responseModel.isSuccessfull = false;
        return of(responseModel);
      })
    );
  }

  PATCH(url: string, body: any, spinner = true): Observable<AppResponse> {
    let responseModel = new AppResponse();
    let serviceURL = this.AppData.baseURL;
    if (serviceURL == null) {
      responseModel.ErrorMessage = "Please Configure Application Settings!!";
      responseModel.isSuccessfull = false;
      return of(responseModel);
    } else {
      url = serviceURL + url;
    }
    if (spinner) {
      this.Request.next(++this.RequestCount);
    }

    let headers = new HttpHeaders().set("Authorization", this.masterData.SessionKey);
    return this.http.patch<AppResponse>(url, body, { headers }).pipe(
      map((response) => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        return response;
      }),
      catchError(error => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        responseModel.ErrorMessage = error.message;
        responseModel.isSuccessfull = false;
        return of(responseModel);
      })
    );
  }

  PUT(url: string, body: any, spinner = true): Observable<AppResponse> {
    let responseModel = new AppResponse();
    let serviceURL = this.AppData.baseURL;
    if (serviceURL == null) {
      responseModel.ErrorMessage = "Please Configure Application Settings!!";
      responseModel.isSuccessfull = false;
      return of(responseModel);
    } else {
      url = serviceURL + url;
    }
    if (spinner) {
      this.Request.next(++this.RequestCount);
    }

    let headers = new HttpHeaders().set("Authorization", this.masterData.SessionKey);
    return this.http.put<AppResponse>(url, body, { headers }).pipe(
      map((response) => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        return response;
      }),
      catchError(error => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        responseModel.ErrorMessage = error.message;
        responseModel.isSuccessfull = false;
        return of(responseModel);
      })
    );
  }


  DELETE(url: string, spinner = true): Observable<AppResponse> {
    let responseModel = new AppResponse();
    let serviceURL = this.AppData.baseURL;
    if (serviceURL == null) {
      responseModel.ErrorMessage = "Please Configure Application Settings!!";
      responseModel.isSuccessfull = false;
      return of(responseModel);
    } else {
      url = serviceURL + url;
    }
    if (spinner) {
      this.Request.next(++this.RequestCount);
    }

    let headers = new HttpHeaders().set("Authorization", this.masterData.SessionKey);
    return this.http.delete<AppResponse>(url, { headers }).pipe(
      map((response) => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        return response;
      }),
      catchError(error => {
        if (spinner) {
          this.Request.next(--this.RequestCount);
        }
        responseModel.ErrorMessage = error.message;
        responseModel.isSuccessfull = false;
        return of(responseModel);
      })
    );
  }

}

export class AppResponse {
  isSuccessfull = false;
  data: any;
  message = "";
  ErrorMessage = "";
  items: any;
  DataSet: any;
}


