import { Injectable } from '@angular/core';
import * as CryptoJS from 'crypto-js';
import * as UUID from 'uuid';
// import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root',
})
export class PaymentService {
  SECRET_KEY: string =
    '0307759849da45ed888edf363363aa9685bdc02de713424cac3826e3bf8a2089a716c1fb24b64cacb24e2f0e344c7b47e5f03677f41c478a8fd2e4faf98a2c7a2a409d17d9264d6183f6ef13459c3fc0874c2181573448f99b9367fd280a17c65f4aa032027945eea33eee6135b55ec2e061f3030a5b4803bc58c3158e49dc9e';

  constructor() {}

  initPayment() {
    let signedFieldNames =
      'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,payment_method,bill_to_forename,bill_to_surname,bill_to_email,bill_to_phone,bill_to_address_line1,bill_to_address_city,bill_to_address_state,bill_to_address_country,bill_to_address_postal_code';

    let payment: any = {
      access_key: 'a7c8045347d33447a4367559f46177c6',
      profile_id: 'CCBEA78D-8382-4ADC-89E3-7E0FBCD30C03',
      signed_field_names: signedFieldNames,
      unsigned_field_names: 'card_type,card_number,card_expiry_date',
      locale: 'en',
      transaction_uuid: UUID.v4(),
      signed_date_time: this.getUTCDate(), //"2017-02-28T14:38:33Z",
      transaction_type: 'authorization',
      reference_number: '',
      amount: '',
      currency: 'USD',
      payment_method: 'card',
      bill_to_forename: '',
      bill_to_surname: '',
      bill_to_email: '',
      bill_to_phone: '',
      bill_to_address_line1: '1 Card Lane',
      bill_to_address_city: 'My City',
      bill_to_address_state: 'CA',
      bill_to_address_country: 'US',
      bill_to_address_postal_code: '',
      card_type: '',
      card_number: '4242424242424242',
      card_expiry_date: '12-2020',
      signature: '',
    };

    return payment;
  }

  private getUTCDate(): string {
    var now = new Date();
    var now_utc =
      now.getUTCFullYear() +
      '-' +
      this.appendZero(now.getUTCMonth() + 1) +
      '-' +
      this.appendZero(now.getUTCDate()) +
      'T' +
      this.appendZero(now.getUTCHours()) +
      ':' +
      this.appendZero(now.getUTCMinutes()) +
      ':' +
      this.appendZero(now.getUTCSeconds()) +
      'Z';
    return now_utc;
  }

  private appendZero(digit: any): string {
    if (digit < 10) return '0' + digit;
    else return digit;
  }

  calculateHash(fieldValues: string[]): string {
    const dataToHash = fieldValues.join(',');
    const hash = CryptoJS.HmacSHA256(dataToHash, this.SECRET_KEY);
    const base64Hash = CryptoJS.enc.Base64.stringify(hash);
    return base64Hash;
  }

  encrypt(formData: any, isValid: any): any {
    if (isValid) {
      let signedFields = formData.signed_field_names.split(',');

      let fieldValues: any = [];

      signedFields.forEach((item: any) => {
        fieldValues.push(item + '=' + formData[item]);
      });

      let hash = this.calculateHash(fieldValues);

      return hash;
    }
  }
}
