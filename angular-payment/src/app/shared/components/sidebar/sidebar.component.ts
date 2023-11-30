import { Component, OnInit } from '@angular/core';
import { SidebarService } from '../../services/sidebar.service';

@Component({
  selector: 'app-sidebar',
  templateUrl: './sidebar.component.html',
  // template: `
  //   <div class="sidebar-content">
  //     <ng-container *ngFor="let component of componentList">
  //       <ng-container [ngComponentOutlet]="component"></ng-container>
  //     </ng-container>
  //   </div>
  // `,
})
export class SidebarComponent implements OnInit {
  componentList: any[] = [];
  sidebarVisible =false;
  constructor(private sidebarService: SidebarService) {}

  ngOnInit() {
    this.componentList = this.sidebarService.getComponentList();
    this.sidebarVisible = true
  }
}
