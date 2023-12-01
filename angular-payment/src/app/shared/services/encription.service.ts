import { Injectable } from '@angular/core';
import * as CryptoJS from 'crypto-js';
@Injectable({
  providedIn: 'root',
})
export class EncriptionService {
  publicKey = 'lbwyBzfgzUIvXZFShJuikaWvLJhIVq36';
  secretForHashing = 'bwebuwbeudbwedybewudew';
  constructor() {}

  public encryptData(data: any) {
    try {
      return CryptoJS.AES.encrypt(
        JSON.stringify(data),
        this.publicKey
      ).toString();
    } catch (e) {
      console.log(e);
    }
  }

  public decryptData(data: any) {
    try {
      const bytes = CryptoJS.AES.decrypt(data, this.publicKey);
      if (bytes.toString()) {
        return JSON.parse(bytes.toString(CryptoJS.enc.Utf8));
      }
      return data;
    } catch (e) {
      console.log(e);
    }
  }

  generateSignature(data: any): string {
    const jsonString = JSON.stringify(data);
    const signature = CryptoJS.HmacSHA256(
      jsonString,
      this.secretForHashing
    ).toString(CryptoJS.enc.Hex);
    return signature;
  }
}
