<?php

namespace App\Http\Controllers\Api;

use App\Actions\Emails\CreateEmailAction;
use App\Actions\Emails\ShowEmailsAction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailRequest;
use App\Http\Resources\EmailResource;
use Illuminate\Http\JsonResponse;

/**
 * Email Controller
 */
class EmailController extends Controller
{
    /**
     * Show all emails
     * Controller logic should be moved to a action/repository/model
     *
     * @param Request $request
     * @return JsonResponse[EmailResource]
     */
    public function index(Request $request): JsonResponse
    {
        $emails = ShowEmailsAction::run($request->query('sent'));
        return EmailResource::collection($emails)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    /**
     * Store an email
     *
     * @param EmailRequest $request
     * @return JsonResponse
     */
    public function store(EmailRequest $request): JsonResponse
    {
        $email = CreateEmailAction::run($request->getEmailData(), $request->getAttachmentData());
        return (new EmailResource($email))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
