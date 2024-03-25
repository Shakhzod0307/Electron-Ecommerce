<?php
use App\Services\EskizService;

class SmsController extends Controller
{
    protected $eskizService;

    public function __construct(EskizService $eskizService)
    {
        $this->eskizService = $eskizService;
    }

    public function sendSms(Request $request)
    {
        $recipient = $request->input('recipient');
        $message = $request->input('message');

        $this->eskizService->sendSms($recipient, $message);

        return response()->json(['message' => 'SMS sent successfully']);
    }
}
