<?php
/**
 * This file is part of the Alom project.
 *
 * (c) Alexandre Salomé <alexandre.salome@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Alom\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Alom\WebsiteBundle\Entity\PostComment;

class PostCommentController extends Controller
{
    public function deleteAction($id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('AlomWebsiteBundle:PostComment')->find($id);

        if (!$comment) {
            throw new NotFoundHttpException();
        }
        $comment->activate();
        $em->remove($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('blog_post_view', array('slug' => $comment->getPost()->getSlug())));
    }

    public function deleteCommentsAction($id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AlomWebsiteBundle:Post')->find($id);

        $comments = $post->getComments();
        if (!empty($comments)) {
            foreach($comments as $comment) {
                $em->remove($comment);
            }
        }
        $em->flush();

        return $this->redirect($this->generateUrl('blog_post_view', array('slug' => $post->getSlug())));
    }

    public function activateAction($id)
    {
        if (! $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('AlomWebsiteBundle:PostComment')->find($id);

        if (!$comment) {
            throw new NotFoundHttpException();
        }
        $comment->activate();
        $em->persist($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('blog_post_view', array('slug' => $comment->getPost()->getSlug())));
    }

    public function inactivateAction($id)
    {
        if (! $this->get('security.context')->isGranted('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('AlomWebsiteBundle:PostComment')->find($id);

        if (!$comment) {
            throw new NotFoundHttpException();
        }
        $comment->inactivate();
        $em->persist($comment);
        $em->flush();

        return $this->redirect($this->generateUrl('blog_post_view', array('slug' => $comment->getPost()->getSlug())));
    }
}
