import { Injectable,EventEmitter  } from '@angular/core';
import { AppComponent } from 'src/app/app.component';

@Injectable()
export class SidebarService {
  private componentList: any[] = [];
  private properties: any = {
    width: '20vw',
    position: 'right',
  }
  private header: String;
  private data: any; 
  sidebarEvent = new EventEmitter<any>();

  addComponent(header: String, component: any, properties: any, data: any) {
    this.header = header;
    this.componentList.push(component);
    this.properties = properties;
    this.data = data;
    //extract footer ng-template from component
  }

  removeComponent() {
    this.componentList = [];
    this.properties = {};
    this.header = ''; 

  }

  getData() {
    return this.data;
  }

  getComponentList() {
    return this.componentList;
  }

  getProperties() {
    return this.properties;
  }

  getHeader() {
    return this.header;
  }


}
