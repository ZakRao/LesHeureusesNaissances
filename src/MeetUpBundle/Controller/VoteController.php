<?

namespace MeetUpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppUserBundle\Entity\User;
use MeetUpBundle\Entity\UserVote;
use MeetUpBundle\Entity\Vote;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class VoteController extends Controller
{

	public function addVote1Action($id, Request $request)
	{
		$user = $this->container->get('security.context')->getToken()->getUser();

		$em = $this->getDoctrine()->getManager();

		$meetup = $em->getRepository('MeetUpBundle:MeetUp')->find($id);
		$vote = $meetup->getVote1();

		$request = request::createFromGlobals();
		$path = $request->getPathInfo();
		if('/ajout_vote_jour1/'.$id === $path){
			$vote1 = $vote->getVote1()+1;
			$vote->setVote1($vote1);
			$vote->addVote1user($user);
			$user->addUsers1vote($vote);
		}

		$em->persist($vote);
		$em->flush();

		return $this->redirectToRoute('meet_up_view',array('id' => $meetup->getId()));
	}


	public function removeVote1Action($id, Request $request)
	{
		$user = $this->container->get('security.context')->getToken()->getUser();

		$em = $this->getDoctrine()->getManager();

		$meetup = $em->getRepository('MeetUpBundle:MeetUp')->find($id);
		$vote = $meetup->getVote1();

		$request = request::createFromGlobals();
		$path = $request->getPathInfo();
		if('/suppression_vote_jour1/'.$id === $path){
			$vote1 = $vote->getVote1()-1;
			$vote->setVote1($vote1);
			$vote->removeVote1user($user);
			$user->removeUsers1vote($vote);	
		}
		
		
		$em->persist($vote);
		$em->flush();

		return $this->redirectToRoute('meet_up_view',array('id' => $meetup->getId()));
	}

	public function addVote2Action($id, Request $request)
	{
		$user = $this->container->get('security.context')->getToken()->getUser();

		$em = $this->getDoctrine()->getManager();

		$meetup = $em->getRepository('MeetUpBundle:MeetUp')->find($id);
		$vote = $meetup->getVote2();


		$request = request::createFromGlobals();
		$path = $request->getPathInfo();
		if('/ajout_vote_jour2/'.$id === $path){
			$vote2 = $vote->getVote2()+1;
			$vote->setVote2($vote2);
			$vote->addVote2user($user);
			$user->addUsers2vote($vote);
		}

		$em->persist($vote);
		$em->flush();

		return $this->redirectToRoute('meet_up_view',array('id' => $meetup->getId()));
	}


	public function removeVote2Action($id, Request $request)
	{
		$user = $this->container->get('security.context')->getToken()->getUser();

		$em = $this->getDoctrine()->getManager();

		$meetup = $em->getRepository('MeetUpBundle:MeetUp')->find($id);
		$vote = $meetup->getVote2();

		$request = request::createFromGlobals();
		$path = $request->getPathInfo();
		if('/suppression_vote_jour2/'.$id === $path){
			$vote2 = $vote->getVote2()-1;
			$vote->setVote2($vote2);
			$vote->removeVote2user($user);
			$user->removeUsers2vote($vote);	
		}
		
		
		$em->persist($vote);
		$em->flush();

		return $this->redirectToRoute('meet_up_view',array('id' => $meetup->getId()));
	}


	public function addVote3Action($id, Request $request)
	{
		$user = $this->container->get('security.context')->getToken()->getUser();

		$em = $this->getDoctrine()->getManager();
		
		$meetup = $em->getRepository('MeetUpBundle:MeetUp')->find($id);
		$vote = $meetup->getVote3();

		$request = request::createFromGlobals();
		$path = $request->getPathInfo();
		if('/ajout_vote_jour3/'.$id === $path){
			$vote3 = $vote->getVote3()+1;
			$vote->setVote3($vote3);
			$vote->addVote3user($user);
			$user->addUsers3vote($vote);
		}

		$em->persist($vote);
		$em->flush();

		return $this->redirectToRoute('meet_up_view',array('id' => $meetup->getId()));
	}


	public function removeVote3Action($id, Request $request)
	{
		$user = $this->container->get('security.context')->getToken()->getUser();

		$em = $this->getDoctrine()->getManager();
		
		$meetup = $em->getRepository('MeetUpBundle:MeetUp')->find($id);
		$vote = $meetup->getVote3();

		$request = request::createFromGlobals();
		$path = $request->getPathInfo();
		if('/suppression_vote_jour3/'.$id === $path){
			$vote3 = $vote->getVote3()-1;
			$vote->setVote3($vote3);
			$vote->removeVote3user($user);
			$user->removeUsers3vote($vote);	
		}
		
		
		$em->persist($vote);
		$em->flush();

		return $this->redirectToRoute('meet_up_view',array('id' => $meetup->getId()));
	}

}

?>