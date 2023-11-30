import { Injectable } from '@angular/core';
import { HelperService } from './helper.service';
@Injectable({
  providedIn: 'root'
})
export class MasterDataService {
  constructor(
    private helper: HelperService,
  ) { }

  setUserData(loginData: any) {
    this.CurrentUser = loginData.sessionToken;
    this.SystemSettings = loginData.systemSettings;
    this.MenuList = loginData.menuList;
    this.PermittedLocations = loginData.permittedLocations;
    this.UserLevelPrivilagesList = loginData.userLevelPrivilagesList;
  }



  get SessionKey(): string {
    return localStorage.getItem(AppKeys.SessionKey) ?? "";
  }

  set SessionKey(key: string) {
    localStorage.setItem(AppKeys.SessionKey, key);
  }

  get CurrentUser(): any {
    let userData = localStorage.getItem(AppKeys.CurrentUser) ?? "";
    return JSON.parse(userData);
  }

  set CurrentUser(key: any) {
    this.SessionKey = key.sessionKey;
    localStorage.setItem(AppKeys.CurrentUser, JSON.stringify(key));
  }

  getUserName() {
    return this.CurrentUser.username;
  }

  get SystemSettings(): any {
    let settings = localStorage.getItem(AppKeys.SystemSettings) ?? "";
    return JSON.parse(settings);
  }

  set SystemSettings(key: any) {
    localStorage.setItem(AppKeys.SystemSettings, JSON.stringify(key));
  }

  get MenuList(): any {
    let menus = localStorage.getItem(AppKeys.MenuList) ?? "";
    return JSON.parse(menus);
  }

  set MenuList(key: any) {
    localStorage.setItem(AppKeys.MenuList, JSON.stringify(key));
  }

  get PermittedLocations(): any {
    let locations = localStorage.getItem(AppKeys.PermittedLocations) ?? "";
    return JSON.parse(locations);
  }

  set PermittedLocations(key: any) {
    localStorage.setItem(AppKeys.PermittedLocations, JSON.stringify(key));
  }

  get UserLevelPrivilagesList(): any {
    let locations = localStorage.getItem(AppKeys.UserLevelPrivilagesList) ?? "";
    return JSON.parse(locations);
  }

  set UserLevelPrivilagesList(key: any) {
    localStorage.setItem(AppKeys.UserLevelPrivilagesList, JSON.stringify(key));
  }

  get MeasureTypes(): any {
    let types = localStorage.getItem(AppKeys.MeasureTypes) ?? "";
    return JSON.parse(types);
  }

  set MeasureTypes(key: any) { 
    localStorage.setItem(AppKeys.MeasureTypes, JSON.stringify(key));
  }

  clearLoginData() {
    localStorage.removeItem(AppKeys.SessionKey);
    localStorage.removeItem(AppKeys.CurrentUser);
    localStorage.removeItem(AppKeys.MenuList);
    localStorage.removeItem(AppKeys.SystemSettings);
    localStorage.removeItem(AppKeys.UserLevelPrivilagesList);
    localStorage.removeItem(AppKeys.PermittedLocations);
  }

}

export class AppKeys {
  static readonly SessionKey = "SessionKey";
  static readonly CurrentUser = "CurrentUser";
  static readonly SystemSettings = "SystemSettings";
  static readonly MenuList = "MenuList";
  static readonly PermittedLocations = "PermittedLocations";
  static readonly UserLevelPrivilagesList = "UserLevelPrivilagesList";
  static readonly MeasureTypes = "MeasureTypes";
}
