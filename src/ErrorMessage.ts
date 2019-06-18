export class ErrorMessage {
  private message: string;

  public constructor(message: string){
    this.message = message;
  }

  public toString(){
    // Replicate the format the validation function returns
    return {
      error:{
        message: this.message
      }
    }.toString();
  }
}