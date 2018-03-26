<?php
namespace MauticPlugin\WechatBundle\Controller;

use Mautic\CoreBundle\Controller\FormController;
use Mautic\CoreBundle\Helper\BuilderTokenHelper;
use Mautic\CoreBundle\Helper\EmojiHelper;
use Mautic\CoreBundle\Helper\InputHelper;
use Mautic\CoreBundle\Templating\TemplateNameParser;
use MauticPlugin\WechatBundle\WechatEvents;
use MauticPlugin\WechatBundle\Entity;
use MauticPlugin\WechatBundle\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class ArticleController extends FormController
{
    /**
     * Generates new form and processes post data
     *
     * @param  Article $entity
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction($entity = null)
    {
        $model = $this->factory->getModel('wechat');

        if (!$entity instanceof Article) {
            /** @var \MauticPlugin\WechatBundle\Entity\Article $entity */
            $entity  = $model->getEntity('Article');
        }

        $method  = $this->request->getMethod();

        //set the page we came from
        $action = $this->generateUrl('mautic_wechat_article_action', array('objectAction' => 'new'));

        // $this->factory->getLogger()->error('+++++++++++++model:' . $model->getPermissionBase());
        //create the form
        $form = $model->createForm($entity, $this->get('form.factory'), $action, array('csrf_protection' => false));

        if ($method == 'POST') {
            if (! $cancelled = $this->isFormCancelled($form)) {
                if ($this->isFormValid($form)) {
                    //form is valid so process the data
                    $model->saveEntity($entity);
                }
            }
        }

        return new Response("<html>article new test controller!!!!!!!!!!!</html>", 200, array('Content-Type' => 'text/html; charset=utf-8'));
    }

}
