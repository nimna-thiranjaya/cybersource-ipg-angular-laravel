import { Component } from '@angular/core';
import { Subject, Observable } from 'rxjs';
import { WebcamImage, WebcamInitError, WebcamUtil } from 'ngx-webcam';
import { DynamicDialogRef } from 'primeng/dynamicdialog';

@Component({
  selector: 'app-webcam-view',
  templateUrl: './webcam-view.component.html',
  styleUrls: ['./webcam-view.component.scss']
})
export class WebcamViewComponent {
  public multipleWebcamsAvailable = false;
  public errors: WebcamInitError[] = [];

  public webcamImage: WebcamImage = null;

  private trigger: Subject<void> = new Subject<void>();
  private nextWebcam: Subject<boolean | string> = new Subject<boolean | string>();

  constructor(
    private ref: DynamicDialogRef
  ) { }

  ngOnInit(): void {
    WebcamUtil.getAvailableVideoInputs()
      .then((mediaDevices: MediaDeviceInfo[]) => {
        this.multipleWebcamsAvailable = mediaDevices && mediaDevices.length > 1;
      });
  }

  triggerSnapshot(): void {
    this.trigger.next();
  }

  handleInitError(error: WebcamInitError): void {
    this.errors.push(error);
  }

  handleImage(webcamImage: WebcamImage): void {
    this.webcamImage = webcamImage;
  }

  get triggerObservable(): Observable<void> {
    return this.trigger.asObservable();
  }

  get nextWebcamObservable(): Observable<boolean | string> {
    return this.nextWebcam.asObservable();
  }

  removeImage() {
    this.webcamImage = null;
  }
  saveImage() {
    let data = {
      isSave: true,
      image: this.webcamImage
    }

    this.ref.close(data);
  }
}
