<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller; 
use Elliptic\EC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use kornrunner\Keccak;

class Web3LoginController extends Controller
{
    public function message(): string
    {
        $nonce = Str::random();
        $message = "Sign this message to confirm you own this wallet address. This action will not cost any gas fees.\n\nNonce: " . $nonce;

        session()->put('sign_message', $message);

        return $message;
    }

    public function verify(Request $request): string
    {
        $result = $this->verifySignature(session()->pull('sign_message'), $request->input('signature'), $request->input('address'));
        // If $result is true, perform additional logic like logging the user in, or by creating an account if one doesn't exist based on the Ethereum address

        // if($result){
        //     Auth::login($result); 
        //     return auth()->user()->id;
        //     return redirect()->intended('/user/dashboard');
        // }else{
        //     return redirect()->intended('/user/dashboard');
        // }
        return ($result ? 'OK' : 'ERROR');
    }

    protected function verifySignature(string $message, string $signature, string $address): bool
    {
        $hash = Keccak::hash(sprintf("\x19Ethereum Signed Message:\n%s%s", strlen($message), $message), 256);
        $sign = [
            'r' => substr($signature, 2, 64),
            's' => substr($signature, 66, 64),
        ];
        $recid = ord(hex2bin(substr($signature, 130, 2))) - 27;

        if ($recid != ($recid & 1)) {
            return false;
        } 

        $pubkey = (new EC('secp256k1'))->recoverPubKey($hash, $sign, $recid); 
        $derived_address = '0x' . substr(Keccak::hash(substr(hex2bin($pubkey->encode('hex')), 1), 256), 24);

        return (Str::lower($address) === $derived_address);



        // new code 

        // $ec = new EC('secp256k1');  

        // $msglen = strlen($message);
        // $hash   = Keccak::hash("\x19Ethereum Signed Message:\n{$msglen}{$message}", 256);
        // $sign   = ["r" => substr($signature, 2, 64), "s" => substr($signature, 66, 64)];
        // $recid  = ord(hex2bin(substr($signature, 130, 2))) - 27; 

        // $pubKey = $ec->recoverPubKey($hash, $sign, $recid);

        // $address2 = "0x" . substr(Keccak::hash(substr(hex2bin($pubKey->encode("hex")), 1), 256), 24);

        // if ($address == $address2) {
        //     echo "Success\n";
        // } else {
        //     echo "Fail\n";
        // }
    }
}