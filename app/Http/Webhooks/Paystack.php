<?php namespace App\Http\Webhooks;

use Obrignoni\Webhooks\Http\WebhookRequest;

class Paystack extends WebhookRequest
{

    /**
     * The event field from the headers or the request.
     *
     * Example:
     *
     * $eventField = 'X-GitHub-Event';
     *
     * @var string|null
     */
    protected $eventField = 'HTTP_X_PAYSTACK_SIGNATURE';

    /**
     * Optional. Map each webhook event to a event class. If left empty, event names will be transformed to studly cased classes.
     *
     * Example: For a Github webhook, the pull_request event will be transformed to App\Events\GithubPullRequest.
     *
     * Example #1:
     *
     * $events = [
     *    'pull_request' => 'App\Events\MyCustomEvent',
     * ];
     *
     * Example #2:
     *
     * $events = App\Events\SingleEventForAll;
     *
     * @var array|string
     */
    protected $events = [];

    /**
     * Optional. The authorization handler class. Use a handler in lieu of the authorize method.
     *
     * @var string
     */
    protected $authorization = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize()
    {
        // Authorize the webhook the same way you would with a FormRequest.

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

}
